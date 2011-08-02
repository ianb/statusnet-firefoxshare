{
  "name": "<?php echo common_config('site', 'name') ?>",
  "description": "Post and share messages on <?php echo common_config('site', 'name') ?>",
  "icons": {
    "16": "/favicon.ico"
  },
  "experimental": {
    "services": {
      "link.send": {
        "endpoint": "<?php common_path('main/firefox-share') ?>"
      }
    }
  },
  "installs_allowed_from": ["*"]
}
