<?php

namespace App\Mainframe\Features\Core\Traits;

use Arr;
use Illuminate\Support\MessageBag;
use Validator;

trait Validable
{
    /**
     * @var \Illuminate\Validation\Validator|validator
     */
    public $validator;

    /**
     * @var MessageBag
     */
    public $messageBag;

    /**
     * Setter function for $validator
     *
     * @return $this
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * @return $this
     */
    public function setMessageBag($messageBag)
    {
        $this->messageBag = $messageBag;

        return $this;
    }

    /**
     * Retrieve the singleton messageBag
     *
     * @return \Illuminate\Contracts\Foundation\Application|MessageBag|mixed
     */
    public function messageBag()
    {
        if ($this->messageBag) {
            return $this->messageBag;
        }
        $this->messageBag = resolve(MessageBag::class);

        return $this->messageBag;
    }

    /**
     * Get the validator instance. If not instantiated, then instantiate one with no data
     *  and rules and return
     *
     * @return \Illuminate\Validation\Validator
     */
    public function validator()
    {
        if ($this->validator) {
            return $this->validator;
        }

        $this->validator = Validator::make([], []);

        return $this->validator;
    }

    /**
     * Add an error message to a key-value pair. This will also add the message in a validator object.
     * This reflects in isValid() and isInvalid() method. These methods check the validator error
     * message to determine if the parent e.g., Processor object is valid or not
     *
     * @param  string  $message
     * @param  string|null  $key
     * @return Validable
     */
    public function error($message, $key = null)
    {
        $key = $key ?: 'errors';
        $this->fieldError($key, $message);

        return $this;
    }

    /**
     * Add exception details in validator
     *
     * @param  \Throwable  $e
     * @return mixed
     */
    public function errorException($e)
    {
        return $this->error($e->getFile().':'.$e->getLine().' - '.$e->getMessage());
    }

    /**
     * Add a field-specific error message in validator
     *
     * @param  string  $key
     * @param  string|null  $message
     * @return $this
     */
    public function fieldError($key, $message = null)
    {
        $message = $message ?: $key.' is not valid';
        $this->validator()->errors()->add($key, $message);
        resolve(MessageBag::class)->add('errors', $message);

        return $this;
    }

    /**
     * Check if the validator has any error
     *
     * @return bool
     */
    public function isInvalid()
    {
        return (bool) $this->validator()->messages()->count();
    }

    /**
     * Check if the object/validator is valid.
     *
     * @return bool
     */
    public function isValid()
    {
        return ! $this->isInvalid();
    }

    /**
     * The Message-bag related functions.
     * These functions are used for adding messages under different keys under the messageBag.
     * However, messageBag is isolated from the validator. Error messages in the messageBag
     * don't invalidate the parent class.
     ***********************************/

    /**
     * Add a message to different keys.
     *
     * @return $this
     */
    public function addToMessageBag($bag, $message)
    {
        $this->messageBag()->add($bag, $message);

        return $this;
    }

    /**
     * Add a message under the 'errors' key
     *
     * @return $this
     */
    public function addErrorMessage($message)
    {
        $this->addToMessageBag('errors', $message);

        return $this;
    }

    /**
     * Add/Merge all the errors from a validator instance
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return $this
     */
    public function addValidatorErrors($validator)
    {
        $this->addToMessageBag('errors', ['validation_errors' => $validator->messages()->toArray()]);

        return $this;
    }

    /**
     * Add a message under the 'messages' key. These messages are used in the FE to show as
     * instruction or neutral messages to the user.
     *
     * @return $this
     */
    public function addMessage($message)
    {
        $this->addToMessageBag('messages', $message);

        return $this;
    }

    /**
     * Add a message under the 'messages' key.
     * This is an alias of the existing addMessage function. Notice is used for showing
     * neutral messages in the FE.
     *
     * @alias addMessage
     *
     * @return $this
     */
    public function notice($data)
    {
        return $this->addMessage($data);
    }

    /**
     * Add a message under the 'warnings' key
     *
     * @return $this
     */
    public function addWarning($data)
    {
        $this->addToMessageBag('warnings', $data);

        return $this;
    }

    /**
     * Add a message under the 'warnings' key
     *
     * @alias addMessage
     *
     * @return $this
     */
    public function warning($data)
    {
        return $this->addWarning($data);
    }

    /**
     * Add a message under the 'debug' key
     *
     * @return $this
     */
    public function addDebugMessage($data)
    {
        $this->addToMessageBag('debug', $data);

        return $this;
    }

    /**
     * Get all the messages of a given key
     *
     * @return null|string[]
     */
    public function getMessages($key)
    {
        if (! $this->messageBag()->count()) {
            return null;
        }

        $messages = $this->messageBag()->messages();

        return $messages[$key] ?? null;
    }

    /**
     * Checks if a key has any message
     *
     * @return bool
     */
    public function hasMessages($key)
    {
        return (bool) $this->getMessages($key);
    }

    /**
     * Get all the entries under the 'errors' key
     *
     * @return null|string[]
     */
    public function getErrors()
    {
        return $this->getMessages('errors');
    }

    /**
     * Check if messageBag has any error
     *
     * @return bool
     */
    public function hasErrors()
    {
        return (bool) $this->getMessages('errors');
    }

    /**
     * Get errors as flat string. Return null if none is available.
     *
     * @return string|null
     */
    public function getErrorsAsSting()
    {
        if (! $this->getErrors()) {
            return null;
        }

        return implode(' #', Arr::flatten($this->getErrors()));
    }

    /**
     * Merge external validator object's errors with the local validator object.
     *
     * @param  \Illuminate\Validation\Validator|\Illuminate\Contracts\Validation\Validator  $validator
     * @return $this
     */
    public function mergeValidatorErrors($validator)
    {
        if (property_exists($validator, 'validator')) {
            $validator = $validator->validator;
        }

        $this->validator()->messages()->merge($validator->messages());

        return $this;
    }
}
