while true; do
  inotifywait -r ./test -e modify,close_write,moved_to,move,create,delete &&
  clear &&
  phpunit --configuration phpunit.xml
done