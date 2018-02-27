#!/usr/bin/env bash

while :
  do
    ./../applications/api/bin/console codelytv:domain-events:consume increase_user_total_videos_created_on_video_created 100
  done

