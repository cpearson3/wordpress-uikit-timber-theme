# Bootsmooth Wordpress Theme

A Wordpress Starter Theme built with Bootsmooth and the [Timber Starter Theme](https://github.com/timber/starter-theme).

# Features

* Modern build system for your WordPress stylesheets and javascript sources using Node, Gulp and Sass
* Page layouts built with Timber, a plugin to write WordPress themes with object-oriented code and the Twig Template Engine

## Installation and setup

1. Open a terminal and change to your wp-content/themes folder
2. Clone the repository: git clone https://github.com/cpearson3/bootsmooth-wordpress-theme.git
3. Install node, npm, bower, and gulp
4. Install project dependencies: npm install; bower install
5. Build stylesheet and javascript: gulp build

### Activating the theme

1. Login to the WordPress admin panel
2. Go to Appearance > Themes
3. Select Bootsmooth WordPress
4. Click Activate and reload the site

## Customizing the stylesheet

The main stylesheet source lives in **scss/style.scss** and is compiled to **style.css**.

Here is where you can import Sass libraries, define variables, and create new styles.

## License

MIT License

Copyright (c) 2017 Clarence B Pearson III

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.