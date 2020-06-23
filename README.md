The module is used to capture product events:
- adding
- update
- deleting
then product information is sent to the respective previously provided api.

Plugin installation instructions:
1. install from composer
2. Enter 
    src\Pyz\Zed\Event\EventDependencyProvider.
    We import the library:
    use Quasiris\QuasirisSenderPlugin\Module\Communication\Plugins\Event\Subscriber\QuasirisSenderPluginSubscriber;
    then in the getEventSubscriberCollection () method we add at the bottom:

    public function getEventSubscriberCollection () {
        .....
        $eventSubscriberCollection->add(new QuasirisSenderPluginSubscriber());
        .....
    }

    then we enter in
        config/Shared/config_default.php
    We import the library:
        use Quasiris\QuasirisSenderPlugin\Shared\QuasirisSenderPluginConstants;
    
    we add somewhere in the file:
        $config[QuasirisSenderPluginConstants::MY_SETTING] = [
            'API_URL_MAIN' => main api url (POST),
            'API_URL_TESTING' => url for the api test (POST)
        ];
3. Data should goes to this api 

