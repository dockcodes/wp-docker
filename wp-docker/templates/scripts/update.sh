#!/bin/sh

set -e

. ./.env

echo '\n###################################'
echo "\nUpdating instance for ${BRANCH} branch"
echo '\n###################################\n'

echo "Pulling images..."
docker pull "${DOCKERHUB_REGISTRY}${IMAGE_NAME_APP}:${BRANCH}"

APP_SERVICE="${APP_NAME_DOCKER}_stack_app"
SCHEDULE_SERVICE="${APP_NAME_DOCKER}_stack_schedule"

echo "\nUpdating service: $APP_SERVICE"
docker service update \
    --image "${DOCKERHUB_REGISTRY}${IMAGE_NAME_APP}:${BRANCH}" \
    --force \
    "$APP_SERVICE"
echo "\nUpdating service: $SCHEDULE_SERVICE"
docker service update \
    --image "${DOCKERHUB_REGISTRY}${IMAGE_NAME_APP}:${BRANCH}" \
    --force \
    "$SCHEDULE_SERVICE"

docker container prune -f


echo '\n###################################'
echo "\nInstance for ${BRANCH} branch updated successfully!"
echo '###################################\n'
