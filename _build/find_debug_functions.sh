#!/bin/bash

grep -rnE "(var_dump|print_r|console\.log|error_log|debug\.log|__LINE__)" --include="*.php" --include="*.js" .