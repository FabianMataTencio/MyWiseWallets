<h1>WiseWallet</h1>
<p>
    WiseWallet is a platform developed with <strong>Laravel 11</strong> that allows users 
    to register and monitor their financial goals, income, and expenses. It provides a detailed 
    and clear view of financial habits to encourage informed and responsible decision-making.
</p>
    
<h2>Technologies Used</h2>
<ul>
    <li><strong>Framework:</strong> Laravel 11</li>
    <li><strong>Data Base:</strong> MySQL</li>
    <li><strong>Dependency Management:</strong> Composer</li>
    <li><strong>Frontend:</strong> Node.js y NPM</li>
</ul>
    
<h2>Prerequisites</h2>
<p>Make sure the following components are installed on your system:</p>
<ul>
    <li>PHP >= 8.1</li>
    <li>Composer</li>
    <li>Node.js y NPM</li>
    <li>MySQL</li>
</ul>
    
<h2>Steps to Set Up the Projecto</h2>
<strong>Clone the repository:</strong>
       
    git clone https://github.com/FabianMataT/WiseWallet.git
    cd WiseWallet

<strong>Install backend and frontend dependencies:</strong>

    composer install
    npm install

<strong>Confire the .env file:</strong>

    php -r "file_exists('.env') || copy('.env.example', '.env');"
    php artisan key:generate

<strong>Execute the migrations and seeders:</strong>

    php artisan migrate
    php artisan db:seed

<strong>Optimize the project:</strong>

    php artisan optimize:
    php artisan optimize

<strong>Run the development server:</strong>

    php artisan serve
    npm run dev

<p>The application will be available at <a href="http://localhost:8000" target="_blank">http://localhost:8000</a>.</p>

<h2>Key Features</h2>
<ul>
    <li>Record and track income and expenses.</li>
    <li>Financial goal management.</li>
</ul>
    
<h2>Contributions</h2>
<p>
   If you want to contribute to the development of WiseWallet, create a fork of the project, make your changes, and submit a pull request. All contributions are welcome.
</p>
