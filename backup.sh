#!/bin/bash

cd /home1/idealgro/ || exit

git add .

if ! git diff --cached --quiet; then
    git commit -m "Backup $(date '+%Y-%m-%d %H:%M')"
    git push --force-with-lease origin main

fi
