# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # The vagrant box to build from.
  config.vm.box = "precise64"
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"
  config.vm.hostname = "skeleton"

  # Create a forwarded port mapping.
  config.vm.network "forwarded_port", guest: 80, host: 8000

  # Configure a private network IP.
  config.vm.network "private_network", ip: "192.168.33.10"

  # Sync the root dir to the box.
  config.vm.synced_folder "./", "/skeleton"

  # Run the provision script.
  config.vm.provision "shell", path: "provision.sh"

end
