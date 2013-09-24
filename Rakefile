task :install do
  puts 'Initalizing Submodules'
  system 'git submodule init'
  puts 'Fetching Submodules'
  system 'git submodule update'

  modules = `git submodule`
  modules = modules.split('\n').map do |m|
    /\s(.*?)\z/.match(m)[1]
  end

  modules.each do |m_path|
    puts "Submodule #{m_path} gets installed"
    system "git config -f .gitmodules --remove-section \"submodule.#{m_path}\"; git rm --cached #{m_path}; rm -rf .git/modules/#{m_path}"
  end

  system `git add -A; git commit -am 'Installed Submodules';`
  #system 'composer install'
end

