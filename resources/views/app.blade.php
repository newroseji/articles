@extends(filter_var(env('APP_DEBUG', true)) ? 'debug.welcome' : 'release.welcome')