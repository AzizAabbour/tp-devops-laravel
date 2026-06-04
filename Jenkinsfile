pipeline {
    agent any

    environment {
        // You can define variables here, such as DB configurations for testing
        APP_ENV = 'testing'
    }

    stages {
        stage('Setup') {
            steps {
                echo 'Setting up the environment...'
                sh '''
                    if [ ! -f .env ]; then
                        cp .env.example .env
                    fi
                '''
            }
        }

        stage('Install Dependencies') {
            steps {
                echo 'Installing Composer dependencies...'
                // Using dockerized composer or host composer
                sh 'composer install --no-interaction --prefer-dist'
                
                echo 'Installing NPM dependencies...'
                sh 'npm install'
                
                echo 'Generating Application Key...'
                sh 'php artisan key:generate'
            }
        }

        stage('Code Quality & Testing') {
            steps {
                echo 'Running Laravel Pint for code formatting...'
                sh './vendor/bin/pint --test || echo "Pint formatting issues found"'
                
                echo 'Running PHPUnit tests...'
                // We create a test database before running tests
                sh 'touch database/database.sqlite'
                sh 'php artisan migrate --env=testing --force'
                sh 'php artisan test'
            }
        }

        stage('Build Stage') {
            steps {
                echo 'Building production assets...'
                sh 'npm run build'
                
                echo 'Optimizing application...'
                sh 'php artisan config:cache'
                sh 'php artisan route:cache'
                sh 'php artisan view:cache'
            }
        }

        stage('Deployment Stage') {
            steps {
                echo 'Deploying application...'
                // Simulate deployment
                sh 'echo "Application successfully deployed to production server!"'
            }
        }
    }

    post {
        success {
            echo 'Pipeline executed successfully!'
        }
        failure {
            echo 'Pipeline failed. Please check the logs.'
        }
    }
}
