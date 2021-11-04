#!/usr/bin/env bash

# Files to be compressed:
#   [d] _nuxt
#   [d] blocks
#   [d] includes (ACF Pro)
#   [d] plugin-update-checker-4.11
#   favicon.png
#   functions.php
#   icon.png
#   index.php (copied from generated _nuxt)
#   page-full.php
#   page-gutenberg.php
#   screenshot.png
#   style.css
#   sw.js

PACKAGE_MANAGER=${1:-yarn}

if ! [[ "$PACKAGE_MANAGER" =~ ^(yarn|npm|pnpm)$ ]] ; then
  echo "Incorrect package manager"
  exit 1
fi

echo "ZHP-PL theme bundler"
echo "===================="
echo "Please remember, you should run this script from the repository base directory."
echo "You need to have yarn installed (or other provided package manager), as well as zip (sudo apt install zip)"
echo "You can change the package manager used by typing its name as a parameter, i.e.: './zipTheme.sh npm' to use npm"

mkdir ./zhp-pl

themedir="./packages/theme"
appdir="./packages/app"
blocksdir="./packages/theme/blocks"
zipdir="./zhp-pl"

# Usage: zip_theme
zip_theme() {
  echo "ZIPPING FILES"
  echo "============="

  zip -r zhp-pl.zip ./zhp-pl
}

# Usage: build_theme
build_theme() {
  build_nuxt
  iterate_blocks build_block
}

# Usage: build_nuxt
build_nuxt() {
  echo "BUILDING NUXT THEME"
  echo "==================="

  (cd $appdir && $PACKAGE_MANAGER install && $PACKAGE_MANAGER run generate)
}

# Usage: copy_theme_files
copy_theme_files() {
  echo "COPYING THEME FILES"
  echo "==================="

  cp "$themedir/"{favicon.png,functions.php,icon.png,page-full.php,page-gutenberg.php,screenshot.png,style.css,sw.js} $zipdir # don't copy index.php, copy it from nuxt generated files
  cp -R "./packages/theme/plugin-update-checker-4.11" "./zhp-pl"
  cp -R "$appdir/dist/wp-content/themes/zhp-pl/_nuxt" $zipdir
  cp "$appdir/dist/index.html" "$zipdir/index.php"
  iterate_blocks copy_block_files
}

# Usage: iterate_blocks <function>
# Executes given function for each block, passing block name as parameter
iterate_blocks() {
  for d in "$blocksdir"/*/ ; do
    blockname="${d#$blocksdir/}"
    blockname="${blockname%/}"
    $1 "$blockname"
  done
}

# Usage: copy_block_files <block name>
copy_block_files() {
  echo "COPYING BLOCK FILES: $1"
  echo "===================="

  mkdir -p "$zipdir/blocks/$1"
  cp "$blocksdir/$1/$1.php" "$zipdir/blocks/$1"   # base block file
  cp -R "$blocksdir/$1/build" "$zipdir/blocks/$1" # build files
}

# Usage: build_block <block name>
build_block() {
  echo "BUILDING BLOCK: $1"
  echo "==============="

  (cd "$blocksdir/$1" && $PACKAGE_MANAGER install && $PACKAGE_MANAGER run build)
}

build_theme && copy_theme_files && zip_theme

echo "Zipped theme. Remember, that this zip doesn't include required ACF Pro plugin - you have to provide it by yourself into 'zhp-pl/includes/' directory."

