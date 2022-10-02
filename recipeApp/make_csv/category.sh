#!/bin/bash

curl -s curl -s https://www.ebarafoods.com/recipe/cla_menu/ | pup 'main div:nth-last-of-type(n+2) p json{}' --color > category.json

./category category.json