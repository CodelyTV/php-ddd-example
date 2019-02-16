#!/bin/sh

cd "$(dirname "$0")/../.."

rm -rf .git/hooks

ln -s ../etc/hooks .git/hooks
chmod -R 777 etc/hooks/*
