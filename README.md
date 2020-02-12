
# tool_rocketchat

What is this?
-------------

This is a very simple tool which listens to Moodle log events you specify,
and then it pushes those events into RocketChat.

Obviously you will only want to listen to a very small subset of events.

Recipes
-------

Get alerted whenever an outage is scheduled:

```
\tool_rocketchat\event\rocketchat_test
\auth_outage\event\outage_created
\auth_outage\event\outage_updated
\auth_outage\event\outage_deleted
```


Create a Rocketchat WebHook
---------------------------

1) Visit https://rocketchat.example.com/admin/integrations

2) Click 'New Integration' > 'Incoming WebHook Integration'

3) Choose a name, channel, and set enabled to true and save it

4) Copy the Webhook URL


Configuration
-------------

http://moodle.local/admin/settings.php?section=tool_rocketchat

* Set the Rocketchat Webhook URL
* Set the list of events to listen to
* Profit

Support
-------


