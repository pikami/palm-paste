# Palm-paste
Palm-paste is an Open-Source PHP script of a site where you can share text and code snippets.
It's extremely easy to use!
It has syntax highlight, ability to post public/unlisted/private pastes and many more cool features.
It's in active development so stay tuned for updates.
Also if you have any ideas you can contact me on twitter, I'm @pik4mi
If you have any issues, file them here https://github.com/pikami/palm-paste/issues

#Note
Original development environment is Apache 2.4 + PHP5.6 + MySQL.
Should work with Nginx and any PDO-compatible database.

#Install
For the purposes of this guide, we won't cover setting up Apache, PHP, MySQL, or Nginx.
So we'll just assume you already have them all running well.

1. Download palm-paste from https://github.com/pikami/palm-paste/tags
2. Create a user and database for palm-paste
3. Take the 'palm-paste.sql' and import it to your database.
4. Edit configuration settings in config/config.php
5. Change the "RewriteBase" setting in ".htaccess" file to the root of your palm-paste installation
6. Done!

* To ensure that pastes with an expiration set get cleaned up, define the cron key in the config and set up a cronjob, for example:
  * `*/5 * * * * curl --silent http://your-site.com/palm-paste/cronjob.php?key=[key]`
* If you can't have cronjobs or your just to lazy - Don't wory, the pastes will expire if a user tries to view them after expiration time is over.

# Things used to make this
- Bootstrap (v3.3.6) Link: http://getbootstrap.com/
- JQuery (v1.12.0) Link: https://jquery.com/
- Dynatable (v0.3.1) Link: https://www.dynatable.com/
- SyntaxHighlighter (v3.0.83) http://alexgorbatchev.com/SyntaxHighlighter/
- Chosen (v1.5.1) Link: https://harvesthq.github.io/chosen/

And many more...
(I'm saying "many more", because I probably missed something)
