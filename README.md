# Laminas test

- Fork this project with the dedicated GitHub button
- Edit master or any branch (edit only the module/Application/src directory)
- Then create a pull-request with this branch
- If Travis is green (both unit tests and performance test), you win!

To run the app locally, use [composer](https://getcomposer.org/):

```shell
git clone https://github.com/<your-username>/LaminasTest
cd LaminasTest
composer install
php seed.php
composer serve
```

Then you will be able to see the application on http://localhost:8083

Replace `<your-username>` by your GitHub username.

And use git as usual to push your commits to GitHub.

# The exercise

Here we use log files as a simplified storage system. By running `php seed.php` (you can check what this seeder does in the source code), 4 files are created with random data: **data/cache/2019-06-01.log**, **data/cache/2019-06-02.log**, **data/cache/2019-06-03.log** and **data/cache/2019-06-04.log**, each file represent a day, each line of file represent a hit (1 display of an advertise in someone's browser).

Each line always contains a date-time on 26 characters and an IP on 20 characters.

Currently, the IndexController::indexAction method return fake data. Modify it to return the actual number of lines for each file. (The display of those values as line chart is already working as you can see by running the app with `composer serve`).

You can run unit tests with `composer test`, one of them check values returned by `indexAction` are the ones expected (your main goal). An other one check that `indexAction` is fast enough to be called at least 2000 times per second (your bonus goal).

# Submit

- Submit your answer as a **pull request** on this repository.

- You can send multiple pull requests (if you hesitate between 2 methods, maybe one faster, and an other more accurate or less greedy in memory).

- You can submit a pull request even if it's not finished, in this case put `[WIP]` (work in progress) in the title.
