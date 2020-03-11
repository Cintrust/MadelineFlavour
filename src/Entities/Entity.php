<?php
    /**
     * This file is part of the TelegramBot package.
     *
     * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
     *
     * For the full copyright and license information, please view the LICENSE
     * file that was distributed with this source code.
     */

    namespace Cintrust\MadelineProto\Entities;

    use Cintrust\MadelineProto\Exceptions\InvalidEntity;
    use Cintrust\MadelineProto\Exceptions\InvalidObserverType;
    use Cintrust\MadelineProto\Observers\Observer;
    use Closure;
    use danog\MadelineProto\API;
    use danog\MadelineProto\Tools;
    use Exception;


    /**
     * Class Entity
     *
     * This is the base class for all entities.
     *
     * @link https://core.telegram.org/bots/api#available-types
     *
     * @method string getBotUsername() Return the bot name passed to this entity
     */
    abstract class Entity
    {

        /**
         * the default observer handler
         * @var string
         */
        protected $default_driver = "sync";
        /**
         *
         * @see Entity::notify()
         * @see Entity::handle()
         *
         * @example [//to be executed by the default driver you can override it by predefining a driver
         *          // driver format = ['_'=>'driver_name', 'driver_name'=>[one or more drivers to be executed by the driver]]
         *            Observer::class,
         *              [
         *                '_'=>'async',
         *                'async'=>[//list of observers to be executed by the async driver
         *                          AnObserver::class,
         *                          Array of observer class,
         *                          'observer_group' => [one or more observers],
         *                           'another_group' =>[//this observer group contains
         *                                                [
         *                                                  '_'=>'sync',
         *                                                   'sync'=>[one or more observers to be executed by the sync driver]
         *                                                 ],
         *                                                [
         *                                                  '_'=>'custom',
         *                                                   'custom'=>[one or more observers to be executed by the custom driver]
         *                                                 ],
         *
         *                                              ],
         *                     ]
         *            ]
         * array of observers
         * @var array
         */
        protected $observers = [];

        /**
         * the default observer handler
         * @var bool $notified
         */
        private $notified = null;

        /**
         * Entity constructor.
         *
         * @todo Get rid of the $bot_username, it shouldn't be here!
         * @todo implement notifyOnly and notifyExcept function
         * @todo implement validate to check for valid observers
         * @todo implement default observer loaders
         * @todo implement a way to load user implemented entity
         * @todo implement a way to load user implemented observer
         * @todo put a sample format for sub entities
         * @see Entity::subEntities();
         * @todo consider the behavior of json_encode for some array with unicode characters
         *
         * @param array $data
         * @param string $bot_username
         *
         *
         * @throws InvalidEntity
         */
        public function __construct(array $data, $bot_username = null)
        {
            //Make sure we're not raw_data inception-ing
            if (array_key_exists('raw_data', $data)) {
                if ($data['raw_data'] === null) {
                    unset($data['raw_data']);
                }
            } else {
                $data['raw_data'] = $data;
            }


            $data['bot_username'] = $bot_username ?? "Cintrust301";
            $this->assignMemberVariables($data);
            $this->validate();
        }

        /**
         * Helper to set member variables
         *
         * @param array $data
         */
        protected function assignMemberVariables(array $data)
        {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }
        }

        /**
         * Perform any special entity validation
         *
         * @throws InvalidEntity
         * @todo consider using var_dump or print_r instead of json_encode
         */
        protected function validate()
        {
//        echo static::class;
            if (!isset($this->getProperty('raw_data')['_'])) {
                throw new InvalidEntity('Invalid entity data given: ' . json_encode($this->getRawData(), JSON_PRETTY_PRINT));
            }

        }

        /**
         * Get a property from the current Entity
         *
         * @param mixed $property
         * @param mixed $default
         *
         * @return mixed
         */
        public function getProperty($property, $default = null)
        {
            if (isset($this->$property)) {
                return $this->$property;
            }

            return $default;
        }

        /**
         * Get the raw data passed to this entity
         * @return array
         */
        public function getRawData()
        {
            return $this->getProperty('raw_data');
        }

        /**
         * @return string
         */
        public function getType()
        {
            return $this->getRawData()['_'];
        }

        /**
         * Perform to string
         *
         * @return string
         */
        public function __toString()
        {
            return $this->toJson();
        }

        /**
         * Perform to json
         *
         * @return string
         */
        public function toJson()
        {
            return json_encode($this->getRawData());
        }

        /**
         * Return the variable for the called getter or magically set properties dynamically.
         *
         * @param $method
         * @param $args
         *
         * @return mixed|null
         * @throws InvalidEntity
         */
        public function __call($method, $args)
        {
            //Convert method to snake_case (which is the name of the property)
            $property_name = strtolower(ltrim(preg_replace('/[A-Z]/', '_$0', substr($method, 3)), '_'));

            $action = substr($method, 0, 3);
            if ($action === 'get') {
                return $this->callGet($property_name);
            } elseif ($action === 'set') {
                // Limit setters to specific classes.
//            if ($this instanceof InlineEntity || $this instanceof Keyboard || $this instanceof KeyboardButton) {
//                $this->$property_name = $args[0];
//
                return $this;
//            }
            }

            return null;
        }

        /**
         * @param $property_name
         * @return array|DefaultEntity|Entity|mixed
         * @throws InvalidEntity
         */
        private function callGet($property_name)
        {

            $obj_property = "obj_$property_name";
            if (isset($this->$obj_property) && (!is_null($this->$obj_property))) {
                return $this->$obj_property;
            }


            $property = $this->getProperty($property_name);

            if ($property !== null) {


                //Get all sub-Entities of the current Entity
                //check if we have a predefined class options for it
                if (isset($this->subEntities()[$property_name])) {

                    //type cast it to array just to
                    // avoid checking if its array again
                    $property = (array)$property;
                    //check if we are intercepting a possible entity type
                    if (isset($property['_'])) {
                        //we try to create the entity type
                        $property = $this->makeObject($property_name, $property);
                    } else {//else we may be intercepting an array of entity types
                        //we try to retrieve the array entity types

                        $property = $this->makePrettyObjectArray($property_name, $property);
                    }
                } elseif (is_array($property)) {//we are intercepting an array elements

                    if (isset($property['_'])) {//check if array is a possible unaccounted sub_entity

                        $property = $this->getDefaultEntity($property);//retrieve the default entity class
                    } else {//else might be array of sub entities or just array of flat data

                        $property = $this->makePrettyDefaultObjects($property);
                    }
                }

                $this->$obj_property = $property;

            }
            return $property;

        }

        /**
         * Get the list of the properties that are themselves Entities
         *
         * @return array
         *
         *
         */
        protected function subEntities()
        {
            /*                        'default' =>MessageMedia::class
             *                          ],
             *      'reply_markup' =>[
             *                        'replyKeyBoardHide'=>replyKeyboardHide::class,
             *                        'replyKeyBoardMarkup'=>replyKeyboardMarkup::class,
             *                        'default'=>ReplyMarkup::class,
             *                           ]
             *      'entities'     =>  [
             *                           'messageEntityUnknown'=>messageEntityUnknown::class,
             *                           'messageEntityMention'=>messageEntityMention::class,
             *                           'default'=>MessageEntity::class,
             *                           ]
             *          'to_id'   =>  [
             *                         'peerUser'=>PeerUser::class,
             *                         'peerChat'=>PeerChat::class,
             *                         'peerChannel'=>PeerChannel::class,
             *                         ]
             *
             * ]
             *
             *
             * */
            return [];
        }

        /**
         * @param $property_name
         * @param array $data
         * @return DefaultEntity|Entity
         * @throws InvalidEntity
         */
        protected function makeObject($property_name, array $data)
        {
            //we get the entity class or array of entity class
            //attached to the property
            //note we don't check if property_name exits
            //calling function should explicitly  check for it
            $className_or_array = $this->subEntities()[$property_name];

            if (is_array($className_or_array)) {
                if (isset($className_or_array[$data['_']])) {
                    //property exists and we found a possible class type
                    //can throw error if invalid class type or invalid data
                    /** @var Entity $obj *///or subclass of Entity
                    $obj = new $className_or_array[$data['_']]($data);
                } elseif ($className_or_array['default']) {
                    //property exist so we can't create the class
                    // but a default fall back was specified
                    $obj = new $className_or_array['default']($data);
                    /** @var Entity $obj *///or subclass of Entity
                    $obj->notifyNow();//we propagate the event instantly
                } else {
                    //property exists but we cant create the class type
                    // and no default was specified so we use our fallback
                    $obj = $this->getDefaultEntity($data, ['_property_' => $property_name]);
                }
            } else {
                //property exist and lets try and create the class type
                //can throw error if invalid class type or invalid data
                /** @var Entity $obj *///or subclass of Entity
                $obj = new $className_or_array($data);

            }
            return $obj;
        }

        public function notifyNow($api = null)
        {
            $returned = true;
            $init = function () use (&$returned, $api) {
                $returned = yield $this->notify($api);
            };
            Tools::callForkDefer($init());
            return $returned;
        }

        /**
         * @param null $api
         * @return \Generator|bool
         */
        public function notify($api = null)
        {

            if (!is_null($this->notified))
                return $this->notified;

            return $this->notified = yield $this->handle($api, $this->observers, $this->default_driver);

        }

        protected function handle($api, array $observers, string $driver = null)
        {
            //check if the current array of observers have a predefined driver
            if (isset($observers['_'])) {
                // [
                //   '_' => 'sync', //predefined driver
                //   'sync' => [array of observers or multi dimensional array of observers],
                //
                // ]
                $method = $observers['_'];//get predefined driver;
//            $observers = $observers[$method];
                if (isset($observers[$method])) {//check if driver has observers attached to it
                    $observers = (array)$observers[$method];// cast the observers
                    // to array in case we just have one observer
                } else {//if we cant find the observers attached
                    // to the predefined driver, clear out observer array
//                $observers = [];//will consider deleting this
                    // line until i find a better way to handle the edge case

                    return true;//nothing more to do
                }
            } elseif (!is_null($driver)) {//if $driver was not null
                // we use it
                $method = $driver;
            } else {
                //fallback driver
                $method = $this->default_driver;
            }
            //we call the driver method
            $method .= "Execution";
            return yield $this->$method($api, $observers);

        }

        /**
         * @param array $data
         * @param array $optional
         * @param bool $notify
         * @return DefaultEntity
         * @throws InvalidEntity
         *
         */
        protected function getDefaultEntity(array $data = ['_' => "DefaultEntity"], array $optional = [], $notify = true)
        {
            !isset($optional['_class_']) ? : ($optional['_class_'] = static::class);
            !isset($optional['_property_']) ? : ($optional['_property_'] = "some property");
            array_merge($data, $optional);
            $obj = new DefaultEntity($data);
            if ($notify) {
                $obj->notifyNow();
            }
            return $obj;

        }

        /**
         * Return an array of nice objects from an array of object arrays
         *
         * This method is used to generate pretty object arrays
         * mainly for PhotoSize and Entities object arrays.
         *
         * @param string $property_name
         * @param array $objects
         * @return array
         */
        protected function makePrettyObjectArray(string $property_name, array $objects)
        {
            $new_objects = [];

            try {
                foreach ($objects as $object) {
                    if (is_array($object) && isset($object['_'])) {//check if we have a possible entity type
                        //get the object
                        //throws error
                        $new_objects[] = $this->makeObject($property_name, $object);
                    } else {
                        $new_objects[] = $object;//just flat data :B
                    }
                }
            } catch (Exception $e) {
                $new_objects = [];
            }

            return $new_objects;
        }

        /**
         * @param array $objects
         * @param string $property_name
         * @return array
         */
        protected function makePrettyDefaultObjects(array $objects, $property_name = "default")
        {
            $new_objects = [];

            try {
                foreach ($objects as $object) {
                    //check if current object is a possible entity
                    if (is_array($object) && isset($object['_'])) {
                        //get the default entity class
                        //throws error
                        $new_objects[] = $this->getDefaultEntity($object, ['_property_' => $property_name]);
                    } else {
                        //object is just a type we are interested in :D
                        $new_objects[] = $object;
                    }
                }
            } catch (Exception $e) {
                $new_objects = [];  //will consider returning removing this line
            }

            return $new_objects;
        }

        /**
         * Try to mention the user
         *
         * Mention the user with the username otherwise print first and last name
         * if the $escape_markdown argument is true special characters are escaped from the output
         *
         * @param bool $escape_markdown
         *
         * @return string|null
         */
        public function tryMention($escape_markdown = false)
        {
            //TryMention only makes sense for the User and Chat entity.
//        if (!($this instanceof User || $this instanceof Chat)) {
//            return null;
//        }

            //Try with the username first...
            $name = $this->getProperty('username');
            $is_username = $name !== null;

            if ($name === null) {
                //...otherwise try with the names.
                $name = $this->getProperty('first_name');
                $last_name = $this->getProperty('last_name');
                if ($last_name !== null) {
                    $name .= ' ' . $last_name;
                }
            }

            if ($escape_markdown) {
                $name = $this->escapeMarkdown($name);
            }

            return ($is_username ? '@' : '') . $name;
        }

        /**
         * Escape markdown special characters
         *
         * @param string $string
         *
         * @return string
         */
        public function escapeMarkdown($string)
        {
            return str_replace(
                ['[', '`', '*', '_',],
                ['\[', '\`', '\*', '\_',],
                $string
            );
        }

        /**
         * @param $api
         * @param array $observers
         * @return bool|mixed
         * @throws InvalidObserverType
         */
        protected function syncExecution($api, array $observers)
        {

            $value = true;
            foreach ($observers as $observer) {
                if (is_string($observer)
                    && class_exists($observer)
                    && is_subclass_of($observer, Observer::class)) {

                    /** @var Observer $observer */
                    $observer = new $observer($api, $this);
                    $value = yield  $observer->handle();
                } elseif ($observer instanceof Closure) {
                    $value = yield $observer($api, $this);
                } elseif (is_array($observer)) {
                    $value = yield  $this->handle($api, $observer, "sync");
                } elseif (is_object($observer)
                    && method_exists($observer, 'handle')) {
                    $value = yield $observer->handle($api, $observer);
                } else {
                    throw new InvalidObserverType(" Invalid observer type given");
                }
                if ($value === false) {
                    return $value;
                }
            }
            return (!is_null($value)) ? $value : true;
        }


    }
