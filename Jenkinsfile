pipeline {
    agent any

    environment {
        VPS_HOST = '97.74.90.174'
        VPS_USER = 'root'
        GIT_BRANCH = 'dev'
        REPO_URL = 'git@github.com:filmycart/sportifyv2.git'
    }

    stages {
        stage('SSH to VPS and Pull Git Branch') {
            steps {
                sshagent (credentials: ['Nachiyar@1984']) {
                    sh """
                    ssh -o StrictHostKeyChecking=no ${VPS_USER}@${VPS_HOST} << 'EOF'
                        cd /var/www/dev.sportify
                        git fetch origin
                        git checkout ${GIT_BRANCH}
                        git pull origin ${GIT_BRANCH}
                    EOF
                    """
                }
            }
        }
    }
}
