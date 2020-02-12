<a href="https://travis-ci.org/catalyst/moodle-tool_rocketchat">
<img src="https://travis-ci.org/catalyst/moodle-tool_rocketchat.svg?branch=master">
</a>


# tool_rocketchat

What is this?
-------------

This is a very simple tool which listens to Moodle log events you specify,
and then it pushes those events into RocketChat.

Obviously you will only want to listen to a very small subset of events.

Recipes
-------

Get alerted whenever an outage is scheduled or changed:

```
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

If you have issues please log them in github here

https://github.com/catalyst/moodle-tool_rocketchat/issues

Please note our time is limited, so if you need urgent support or want to
sponsor a new feature then please contact Catalyst IT Australia:

https://www.catalyst-au.net/contact-us

This plugin was developed by Catalyst IT Australia:

https://www.catalyst-au.net/

<img alt="Catalyst IT" src="https://cdn.rawgit.com/CatalystIT-AU/moodle-auth_saml2/master/pix/catalyst-logo.svg" width="400">
