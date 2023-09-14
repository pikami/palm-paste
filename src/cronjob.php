<?php
include_once "includes/config.php";

if (isset($_GET["key"])) {
  if ($_GET["key"] == $CRON_ExpireKey) {    //Delete expired pastes
    include_once "repositories/paste-repository.php";
    $pasteRepo = new PasteRepository();
    echo $pasteRepo->removeExpiredPastes();
  }
}
//Cron job example: */5 * * * * curl --silent http://127.0.0.1/paste/cronjob.php?key=fgd45fb5fb15gb > /dev/null
//More about cron jobs: http://www.shellhacks.com/en/Adding-Cron-Jobs-in-Linux-Crontab-Usage-and-Examples
