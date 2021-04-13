# Laminas test

- Clone/fork this project
- Install composer dependencies
- Edit only the **module/Application/src** directory to pass the tests (`./vendor/bin/phpunit`)

To run the app locally, use [composer](https://getcomposer.org/):

```shell
git clone https://github.com/OVNICap/LaminasTest
cd LaminasTest
composer install
php seed.php
composer serve
```

Then you will be able to see the application on http://localhost:8083

You can also use an online IDE such as GitPod:
https://gitpod.io/#https://github.com/OVNICap/LaminasTest

# The exercise

Here we use log files as a simplified storage system. By running `php seed.php` (you can check what this seeder does in the source code), 4 files are created with random data: **data/cache/2021-04-01.log**, **data/cache/2021-04-02.log**, **data/cache/2021-04-03.log** and **data/cache/2021-04-04.log**, each file represent a day, each line of file represent a hit (1 display of an advertise in someone's browser).

Each line always contains a date-time on 26 characters and an IP on 20 characters.

Currently, the IndexController::indexAction method return fake data. Modify it to return the actual number of lines for each file. (The display of those values as line chart is already working as you can see by running the app with `composer serve`).

You should run `composer test` and make the unit tests pass:
- First one checks values returned by `indexAction` are the ones expected (your main goal).
- Second one checks `indexAction` can filter the output by dates `start` and `end` (included) given as params from URL query.
- The third one checks that `indexAction` is fast enough to be called at least 2000 times per second (your bonus goal).

# Submit

Send a ZIP archive with your **module/Application/src** directory (any modification done elsewhere will be ignored).

You can run:
```
php zip.php
```

To produce the **src.zip** automatically in the project root directory.
