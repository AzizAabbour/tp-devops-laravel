pipeline {
    agent any

    stages {
        stage('Clone Repository') {
            steps {
                // Jenkins récupère automatiquement le code depuis GitHub si configuré "Pipeline script from SCM"
                // Mais on peut ajouter checkout scm pour être explicite
                checkout scm
            }
        }

        stage('Install Dependencies') {
            steps {
                echo 'Installation des dépendances Composer et NPM...'
                sh 'composer install --no-interaction --prefer-dist'
                sh 'npm install'
                
                // Préparation de l'environnement
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
            }
        }

        stage('Laravel Check') {
            steps {
                echo 'Vérification du code Laravel...'
                sh './vendor/bin/pint --test || echo "Des problèmes de formatage ont été trouvés (non bloquant)"'
            }
        }

        stage('Run Tests') {
            steps {
                echo 'Exécution des tests PHPUnit...'
                // Configuration d'une base de données SQLite pour les tests
                sh 'touch database/database.sqlite'
                sh 'php artisan migrate --env=testing --force'
                
                // Lancement des tests
                sh 'php artisan test'
            }
        }
    }

    post {
        success {
            echo 'SUCCESS'
        }
        failure {
            echo 'FAILED'
        }
    }
}
