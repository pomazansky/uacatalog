# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.box = "ubuntu/trusty32"
  config.vm.network "forwarded_port", guest: 80, host: 8888

  config.vm.synced_folder "./", "/var/www/uacatalog"

  config.vm.provision "shell", inline: <<-SHELL
    sudo apt-get update
    echo mysql-server mysql-server/root_password select "password" | debconf-set-selections
    echo mysql-server mysql-server/root_password_again select "password" | debconf-set-selections
    sudo apt-get install -y apache2 php5 php5-intl mysql-server
    sudo sed -i 's/\\/var\\/www\\/html/\\/var\\/www\\/uacatalog\\/web/g' /etc/apache2/sites-available/000-default.conf
    sudo sed -i 's/www-data/vagrant/g' /etc/apache2/envvars
    sudo service apache2 restart
    mysql -uroot -ppassword -e "create database uacatalog;"
    mysql -uroot -ppassword uacatalog < /var/www/uacatalog/uacatalog.sql
  SHELL
end
