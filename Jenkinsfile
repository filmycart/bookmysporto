pipeline {
    agent any
    stages {
        stage('Deploy') {
            steps {
                sshagent(credentials: ['Nachiyar@1984']) {
                    sh """
                        ssh root@97.74.90.174 'cd /var/www/dev.sportify && ls'
                    """
                }
            }
        }
    }
}