# README #

A Theme for URI Today, based on [underscores](http://underscores.me).

## Preprocessing ##

This theme makes use of Gulp to handle preprocessing.  You'll see that styles.css file is a compact and difficult-to-read stylesheet.  This is because it's compiled from the files in the sass directory.

## Installing Gulp ##

[How to install Gulp](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md).  Note:  You will need to have installed node and npm.


## Setting up this project ##

Switch to this project's directory on your machine:
```
cd path/to/uri-2016
```


install this project's dependencies:
```
npm install
```

run gulp:
```
gulp
```

New css, and js will be created when sass or js files are changed.  It'll watch for changes as you go.  To stop the watcher, use control-C.