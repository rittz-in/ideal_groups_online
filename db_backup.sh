#!/bin/bash

############################################################
# Database Backup Script
# Author: Rizwan
# Description:
#   - Deletes old backups
#   - Creates fresh backups for all databases
#   - Compresses backups
#   - Writes detailed logs
############################################################

BACKUP_DIR="$HOME/ideal_db_backups"
CONFIG_FILE="$HOME/.db_backup.conf"

DATE=$(date +"%Y-%m-%d_%H-%M-%S")
LOG_DATE=$(date +"%Y-%m-%d %H:%M:%S")

TOTAL=0
SUCCESS=0
FAILED=0

mkdir -p "$BACKUP_DIR"

echo "=================================================="
echo "Database Backup Started : $LOG_DATE"
echo "=================================================="

# Delete previous backups
echo ""
echo "Cleaning old backups..."

find "$BACKUP_DIR" -type f -name "*.sql" -delete
find "$BACKUP_DIR" -type f -name "*.sql.gz" -delete

echo "Old backups removed."
echo ""

while IFS="|" read -r DB_NAME DB_USER DB_PASS
do

    # Skip comments and blank lines
    [[ -z "$DB_NAME" || "$DB_NAME" =~ ^# ]] && continue

    TOTAL=$((TOTAL+1))

    FILE="$BACKUP_DIR/${DB_NAME}_${DATE}.sql"

    echo "----------------------------------------"
    echo "Database : $DB_NAME"
    echo "Started  : $(date +"%H:%M:%S")"

    mysqldump \
        -h localhost \
        -u "$DB_USER" \
        -p"$DB_PASS" \
        --single-transaction \
        --quick \
        --routines \
        --triggers \
        "$DB_NAME" > "$FILE"

    if [ $? -eq 0 ]; then

        gzip "$FILE"

        SUCCESS=$((SUCCESS+1))

        echo "Status   : SUCCESS"

    else

        FAILED=$((FAILED+1))

        rm -f "$FILE"

        echo "Status   : FAILED"

    fi

    echo ""

done < "$CONFIG_FILE"

echo "=================================================="
echo "Backup Summary"
echo "=================================================="

echo "Total Databases : $TOTAL"
echo "Successful      : $SUCCESS"
echo "Failed          : $FAILED"

echo ""
echo "Backup Folder:"
echo "$BACKUP_DIR"

echo ""
echo "Completed At : $(date +"%Y-%m-%d %H:%M:%S")"
echo "=================================================="

# Exit with non-zero status if any backup failed
if [ "$FAILED" -gt 0 ]; then
    exit 1
else
    exit 0
fi