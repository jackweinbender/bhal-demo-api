# bhal-api: Backend API for the Biblical Hebrew and Aramaic Lexicon

This is the prototype backend API for the now-defunct Biblical Hebrew and Aramaic Lexicon project ([Demo](https://bhal-demo.herokuapp.com)). The site content is meaningless, but this was an important project for me as a young developer.

## About this project
This API was a port from the original Node.js protoype API because the people in charge of deploying the application were more comfortable maintaining a PHP server 🤷. I took the occasion to refamiliarize myself with the Laravel ecosystem which had matured quite a lot in the preceding few years. 

## What I Learned
Because the frontend of the app has already been prototyped using my original [Node/Express API](https://github.com/jackweinbender/bhal-server-node), my goal was to create a drop-in replacement. At the time Ember.js had just moved to using the [JSON-API](https://jsonapi.org/) spec, so I decided that I would take the time to try to make a JSON-API conforming API with Laravel, which at the time lacked any standard JSON-API implementation. Similarly, [Fractal](https://fractal.thephpleague.com/serializers/) had not yet implemented the spec. The result was my [laravel-jsonapi package](https://github.com/jackweinbender/laravel-jsonapi) which, while incomplete and rather inefficient, worked for my purposes. This was the first time I had ever published a package that I thought could have been useful to someone else. 

This project was also my introduction to automated testing and TDD. It was a noble first-attempt, even if it was rather naive, and I really started to understand how useful it was to have a suite of tests to go back and make sure my new code was not causing any regressions.
