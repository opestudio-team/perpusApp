/*
  filename    : logger.js
  Author      : Taufiqur Rohman
  Description : Use this script to override console javascript
*/

// set debug mode. Change to 'false' if in production mode
var DEBUG = false;

// if CUSTOM set to 'true' console will override with custom message
var CUSTOM = true;

// get hostname
var hostName = window.location.hostname;

// set custom message
var customMessage = "Sorry, console-nya tak ambil alih dulu ya!";

var originConsole = console;
var consoleCount = 0;

(function(){
  var _log    = console.log;

  if (!DEBUG) {
    if (CUSTOM) {
      if (consoleCount == 0) {
        // override console with custom message
        console.log = function(message){
          message = customMessage;
          _log.apply(console, arguments);
        };
        console.error = function(message){
          message = customMessage;
          _log.apply(console, arguments);
        };
        console.info = function(message){
          message = customMessage;
          _log.apply(console, arguments);
        };
        console.warn = function(message){
          message = customMessage;
          _log.apply(console, arguments);
        };
        console.debug = function(message){
          message = customMessage;
          _log.apply(console, arguments);
        };
        console.dir = function(message){
          message = customMessage;
          _log.apply(console, arguments);
        };
        console.count = function(message){
          message = customMessage;
          _log.apply(console, arguments);
        };
        consoleCount=1;
      }
    } else {
      console.log   = function(){};
      console.error = function(){};
      console.info  = function(){};
      console.warn  = function(){};
      console.debug = function(){};
    }
  } else {
    /*
      use original console
      For development mode
    */
    console = originConsole;
  }
})();
