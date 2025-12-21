<?php

namespace App\Mainframe\Features\Modular\BaseModule;

/**
 * Interface MfModuleInterface
 *
 * This interface exposes the public API provided by the ModularTrait so that
 * BaseModule (and compatible modules) can be type-hinted consistently.
 */
interface MfModuleInterface
{
    // Default getters
    public function moduleName();
    public function tenantEnabled();
    public function isTenantEnabled();
    public function spreadFields();
    public function getTagFields();
    public function showGlobalTenantElements();
    public function showNonTenantElements();
    public function getAppends();
    public function getWith();

    // Query scopes + Dynamic scopes
    public function scopeActive($query);

    // Relations and helpers
    public function module();
    public function rootModel();

    // Table/field helpers
    public function fields($except = null);
    public function getAttributeKeys();
    public function getAttributeKeysExcept($except = null);
    public function hasColumn($column);
    public function getColumnsThatEndsWith($str);
    public function tableColumns();
    public function columns();

    // Change tracking helpers
    public function latestChanges();
    public function fieldHasChanged($field);
    public function updaterOfField($field);
    public function transition($field);
    public function hasTransition($field, $from, $to);
    public function hasTransitionFrom($field, $from);
    public function hasTransitionTo($field, $to);
    public function allowedTransitionsOf($field, $from);
    public function trackFieldChanges();
    public function track($field);

    // User/tenant context helpers
    public function relatedUserIds();
    public function hasTenantContext();
    public function isTenantCompatible($user);

    // Form helpers
    public function formState();
    public function formMethod();
    public function formAction();
    public function isCreating();
    public function isUpdating();
    public function isEditing();
    public function isCreated();

    // Model operation helpers
    public function disableEvents();
    public function saveQuietly(array $options = []);
    public function processor();
    public function process();
    public function processed();
    public function validate();
    public function linkUploads();
    public function syncSpreadKeys();
    public function syncSpreadTags();
    public function getSpreadTags($field);
    public function autoFill();
    public function autoFillTenant();
    public function markDeleted($by = null, $at = null);
    public function fillModuleAndElement($fieldPrefix );
    public function viewProcessor();

    // URLs and links
    public function indexUrl($params = []);
    public function createUrl($params = []);
    public function storeUrl($params = []);
    public function showUrl($params = []);
    public function editUrl($params = []);
    public function updateUrl($params = []);
    public function destroyUrl($params = []);
    public function datatableJsonUrl($params = []);
    public function listJsonUrl($params = []);
    public function reportUrl($params = []);
    public function uploadsUrl($params = []);
    public function changesUrl($params = []);
    public function cloneUrl($params = []);
    public function editLink($field, $params = []);

    // Ability checks
    public function isViewable();
    public function isCreatable();
    public function isEditable();
    public function isDeletable();
    public function isRestorable();
    public function isCloneable();

    // Eloquent relationships
    public function tenant();
    public function project();
    public function creator();
    public function updater();
    public function linkedModule();
    public function changes();
    public function uploads();
    public function spreads();
    public function spreadModels($slug);
    public function spreadTags($field);
    public function comments();

    // Misc utilities
    public function putTenantSerial();
    public function emailRecipients();
    public function smsRecipients();
    public function syncData();
    public function denormalize();

    // Finders
    public static function byName($name);
    public static function byUuid($uuid);
    public static function bySlug($slug);
    public static function byCode($code);

    // Executables
    public function runCommonExecutablesOnSaved();
    public function runCommonExecutablesOnDeleted();

    // Cache helpers
    public function cachePrefix($field = null);
    public function elementSpecificCacheKeys($field = null);
    public function clearElementCache();

    // Validable (validation and message bag helpers)
    public function setValidator($validator);
    public function setMessageBag($messageBag);
    public function messageBag();
    public function validator();
    public function error($message, $key = null);
    public function errorException($e);
    public function fieldError($key, $message = null);
    public function isInvalid();
    public function isValid();
    public function addToMessageBag($bag, $message);
    public function addErrorMessage($message);
    public function addValidatorErrors($validator);
    public function addMessage($message);
    public function notice($data);
    public function addWarning($data);
    public function warning($data);
    public function addDebugMessage($data);
    public function getMessages($key);
    public function hasMessages($key);
    public function getErrors();
    public function hasErrors();
    public function getErrorsAsSting();
    public function mergeValidatorErrors($validator);
}
