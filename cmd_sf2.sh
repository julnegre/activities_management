#!/bin/bash

php app/console doctrine:generate:entity --entity="JngActivityBundle:ActivityStorage" --fields="activity_id:integer task_id:integer start:datetime end:datetime"

php app/console doctrine:schema:update --force


