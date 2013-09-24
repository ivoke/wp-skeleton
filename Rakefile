task :install do
  Rake::Task["wp:install"].invoke
end

task :update do
  Rake::Task["wp:update"].invoke
end

namespace :wp do
  task :install do
    modules do |m|
      puts "Submodule #{m} gets installed"
      system "rm -rf #{m}/.git"
    end
    system "rm -rf .gitmodules"

    puts "Install Composer Modules"
    Rake::Task["wp:compose_install"].invoke

    puts "Initial commit"
    `rm -rf .git`
    `git init`
    `git add -A`
    `git commit -am 'Initial Commit'`
  end

  task :update do
    system 'composer update'
  end

  task :fetch_modules do
    system 'git submodule init'
    system 'git submodule update'
  end

  task :compose_install do
    system 'composer install'
  end

  def modules
    modules = `git submodule`.split("\n").map do |m|
      /\A\s|-.*?\s(.*?)(\s\(.*?\))?\z/.match(m)[1]
    end

    Rake::Task["wp:fetch_modules"].invoke if modules
    modules.each { |m| yield m } if block_given?
    modules
  end

end
