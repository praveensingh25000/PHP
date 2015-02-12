#!/usr/bin/env bash

CLIGHTS_DIR=/c/Users/salvin/workspace/clights
cp hb_helpers.js templates.js
handlebars templates/*.handlebars >> templates.js

#/c/Users/salvin/AppData/Roaming/npm/handlebars "${CLIGHTS_DIR}/js/templates/"*.handlebars -f "${CLIGHTS_DIR}/js/templates.js"
