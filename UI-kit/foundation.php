<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Foundation Starter Template</title>
  <!-- Compressed CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.3/dist/css/foundation.min.css" integrity="sha256-xpOKVlYXzQ3P03j397+jWFZLMBXLES3IiryeClgU5og= sha384-gP4DhqyoT9b1vaikoHi9XQ8If7UNLO73JFOOlQV1RATrA7D0O7TjJZifac6NwPps sha512-AKwIib1E+xDeXe0tCgbc9uSvPwVYl6Awj7xl0FoaPFostZHOuDQ1abnDNCYtxL/HWEnVOMrFyf91TDgLPi9pNg==" crossorigin="anonymous">

  <!-- Compressed JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.3/dist/js/foundation.min.js" integrity="sha256-/PFxCnsMh+nTuM0k3VJCRch1gwnCfKjaP8rJNq5SoBg= sha384-9ksAFjQjZnpqt6VtpjMjlp2S0qrGbcwF/rvrLUg2vciMhwc1UJJeAAOLuJ96w+Nj sha512-UMSn6RHqqJeJcIfV1eS2tPKCjzaHkU/KqgAnQ7Nzn0mLicFxaVhm9vq7zG5+0LALt15j1ljlg8Fp9PT1VGNmDw==" crossorigin="anonymous"></script>

  <!-- foundation-float.min.css: Compressed CSS with legacy Float Grid -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.3/dist/css/foundation-float.min.css" integrity="sha256-sP0p6J7SbJGiJ2gkdY1nkVsLgdwiFN2kI370lU+zacQ= sha384-yZLxxcD8nfiSt1qfKJWwHwtkL58WZDTlkBnZN60qr3ZS35+LDsmUF2JHLxdyZ+KU sha512-Z3WbpfWFSsK2dBvoSYZnMvPmxSJUa5cxj3TYlmyj6cq8IXy7iB2nlUk+jjms8gnz4HmpQk/yhRSlRzW7keoSlg==" crossorigin="anonymous">

  <!-- foundation-prototype.min.css: Compressed CSS with prototyping classes -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.3/dist/css/foundation-prototype.min.css" integrity="sha256-ksLmXa0k3ACbX6azB9g6l7XlmSKFBkuH0DXKNwULXtE= sha384-RGTvu65DAT+yLQsTj5tnITDrMfrS5mbajNAYILSg4hHr9vRr/3Y9q0WAdChqLKfx sha512-KMJ7XYrv5UcwEvJFaYnLSdN5O3fT7aQvjed//LQPB3AsN4VPA/wXG9j4x4vKZkjNmU/U8aZC9Ac3FYxs9lPXcw==" crossorigin="anonymous">

  <!-- foundation-rtl.min.css: Compressed CSS with right-to-left reading direction -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.3/dist/css/foundation-rtl.min.css" integrity="sha256-jvk46bzgetf2fy3FF19toDOoy9CG3aFqZfd229doSyo= sha384-w6E9ynA6OV6MFswc7C8nr8QoBiRtqqOKF/5M9ZVyVDDyrUPLI75xizNuXgRZxWK5 sha512-7MZk47L+5Mj6Y0dP3NuB2aqlNdDgzTlCf8m50nvgnCHUbxZ9KabCy8VUzQAl/DqDKwR7E6JsCf1MUjkfCiVzJw==" crossorigin="anonymous">

</head>

<body>
  <h1>Hello, world!</h1>
  <ul class="menu">
    <li><a href="#"><i class="fi-list"></i> <span>One</span></a></li>
    <li><a href="#"><i class="fi-list"></i> <span>Two</span></a></li>
    <li><a href="#"><i class="fi-list"></i> <span>Three</span></a></li>
    <li><a href="#"><i class="fi-list"></i> <span>Four</span></a></li>
  </ul>

  <div class="row">
    <div class="columns">
      <h2>Orbit - Text Slider</h2>
      <p>A carousel slide can contain images or HTML—you can even mix between slides in one carousel!</p>
    </div>
  </div>

  <div class="row">
    <div class="columns">
      <div class="orbit" role="region" aria-label="Favorite Text Ever" data-orbit>
        <ul class="orbit-container">
          <button class="orbit-previous" aria-label="previous"><span class="show-for-sr">Previous Slide</span>&#9664;</button>
          <button class="orbit-next" aria-label="next"><span class="show-for-sr">Next Slide</span>&#9654;</button>
          <li class="is-active orbit-slide">
            <div class="docs-example-orbit-slide">
              <p><strong>This is dodgerblue.</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
          </li>
          <li class="orbit-slide">
            <div class="docs-example-orbit-slide">
              <p><strong>This is rebeccapurple.</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
          </li>
          <li class="orbit-slide">
            <div class="docs-example-orbit-slide">
              <p><strong>This is darkgoldenrod.</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
          </li>
          <li class="orbit-slide">
            <div class="docs-example-orbit-slide">
              <p><strong>This is lightseagreen.</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
          </li>
        </ul>
        <nav class="orbit-bullets">
          <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
          <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
          <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
          <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
        </nav>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="columns">
      <ul class="vertical dropdown menu" data-dropdown-menu style="max-width: 250px;">
        <li>
          <a href="#Item-1">Item 1</a>
          <ul class="menu">
            <li><a href="#Item-1A">Item 1A</a></li>
            <li>
              <a href="#Item-1B">Item 1B</a>
              <ul class="menu">
                <li><a href="#Item-1Bi">Item 1B i</a></li>
                <li><a href="#Item-1Bii">Item 1B ii</a></li>
                <li>
                  <a href="#Item-1Biii">Item 1B iii</a>
                  <ul class="menu">
                    <li><a href="#Item-1Biiialpha">Item 1B iii alpha</a></li>
                    <li><a href="#Item-1Biiiomega">Item 1B iii omega</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#Item-1Biv">Item 1B iv</a>
                  <ul class="menu">
                    <li><a href="#Item-1Bivalpha">Item 1B iv alpha</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#Item-1C">Item 1C</a></li>
          </ul>
        </li>
        <li>
          <a href="#Item-2">Item 2</a>
          <ul class="menu">
            <li><a href="#Item-2A">Item 2A</a></li>
            <li><a href="#Item-2B">Item 2B</a></li>
          </ul>
        </li>
        <li><a href="#Item-3">Item 3</a></li>
        <li><a href="#Item-4">Item 4</a></li>
      </ul>
    </div>
  </div>


</body>

</html>