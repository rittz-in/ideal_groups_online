#!/bin/bash

# Go to backup directory
cd /home1/idealgro/ || exit 1

# Limit Git resource usage for shared hosting
git config core.preloadIndex false
git config pack.threads 1

# Log file
LOG="/home1/idealgro/db_backup.log"

echo "==============================" >> $LOG
echo "Backup started: $(date)" >> $LOG

# Add changes
git add . >> $LOG 2>&1

# Check if there are changes
if ! git diff --cached --quiet; then

    echo "Changes found. Creating commit..." >> $LOG

    git commit -m "Backup $(date '+%Y-%m-%d %H:%M')" >> $LOG 2>&1

    echo "Pushing to GitHub..." >> $LOG

    git push origin main >> $LOG 2>&1

    echo "Backup completed: $(date)" >> $LOG

else

    echo "No changes found." >> $LOG

fi

echo "==============================" >> $LOG