Vagrant.configure("2") do |config|
  config.vm.box = "damianlewis/lamp-php7.0"
  config.vm.box_version = "1.1.1"

  config.vm.provider "virtualbox" do |vb|
    vb.memory = "512"
  end

  if File.exists?('.gitconfig')
    config.vm.provision :file, source: ".gitconfig", destination: "/home/vagrant/.gitconfig"
  end
end
