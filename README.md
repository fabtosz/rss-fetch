# RSS Channel Console Fetcher 
PHP console aplication fetching RSS data from given channel and saving to .csv file.

### Requirements
  - PHP installed with environemntal variable added
  - Composer installed

### Installation
Move to main directory after cloning.

Next
```sh
$ composer install
```

Move to directory where console aplication is:
```sh
$ cd src
```

###  Commands
##### csv:simple
Downloads content from given RSS channel and saves to .csv file (new file is created if doesn't exists in path). New contents will be overwritten. 

```sh
php console.php csv:simple $URL $PATH
```
##### csv:extended
Downloads content from given RSS channel and saves to .csv file (new file is created if doesn't exists in path). New contents will be extended. 
```sh
php console.php csv:extended $URL $PATH
```
##### command arguments
  - $URL - RSS channel source (required)
  - $PATH - path to csv file (required)

###  Architecture
PSR-4 autoloading standard; Built on Symfony Console Component (http://symfony.com/doc/current/components/console.html)
