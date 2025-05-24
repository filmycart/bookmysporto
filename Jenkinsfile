pipeline {
    agent any

    environment {
        DEPLOY_DIR = '/var/www/dev.sportify' // adjust as needed
    }

    stages {

        stage('Checkout') {
            steps {
                git credentialsId: 'fmc_git_repo', url: 'git@github.com:filmycart/sportifyv2.git', branch: 'dev'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

       /* stage('Run Tests') {
            steps {
                sh 'vendor/bin/phpunit tests' // assumes PHPUnit is installed via composer
            }
        }*/

        stage('Deploy') {
            steps {
                sshagent(credentials: ['Nachiyar@1984']) {
                    sh """
                        rsync -avz --delete ./ root@97.74.90.174:/var/www/dev.sportify
                        ssh root@97.74.90.174 'cd /var/www/dev.sportify && composer install --no-dev --optimize-autoloader'
                    """
                }
            }
        }
    }

    post {
        success {
            echo 'Deployment successful!'
        }
        failure {
            echo 'Deployment failed.'
        }
    }
}
