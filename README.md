# Magento 2 Admin Grid Example Extension

This extension creates a simple admin grid to display a list of categories that start with a letter `b` or a letter `B`.

Installation instructions:

* Clone the repository

```console
git clone https://github.com/goivvy/admin-grid-tutorial.git
```

* Copy `app` folder

```console
cp -r ~/admin-grid/tutorial/app /path/to/magento2/root/folder
```

* Install and recompile

```console
php bin/magento setup:upgrade
php bin/magento deploy:mode:set production
```

The grid could then be accessed at **Catalog** > **Inventory** > **Category Listing**.
