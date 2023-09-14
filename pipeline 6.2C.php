pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                
                    echo 'mvn clean install'
                }
            
            post {
                success {
                    echo 'Build completed successfully!',
                    mail to: "aleenaf281@gmail.com",
                    subject: "Build Status email",
                    body: "Build was successful!"

                }
                failure {
                    echo 'Build failed!'
                }
            }
        }

        stage('Unit and Integration Tests') {
            steps {
                 
                echo 'mvn test'
                }
            
            post {
                success {
                    echo 'Tests passed!'
                }
                failure {
                    echo 'Tests failed!'
                }
            }
        }

        stage('Code Analysis') {
            steps {
                
                    echo 'mvn sonar:sonar'
                
            }
            post {
                always {
                    echo 'Code analysis completed!'
                }
            }
        }

        stage('Security Scan') {
            steps {
                
                    echo 'mvn org.owasp:dependency-check-maven:check'
                
            }
            post {
                success {
                    echo 'Deployed to staging successfully!'
                    
                }
               
            }
        }

        stage('Deploy to Staging') {
            steps {
                
                    echo 'Deploying to staging...'
                
            }
            post {
                success {
                    echo 'Deployed to staging successfully!'
                }
                failure {
                    echo 'Deployment to staging failed!'
                }
            }
        }

        stage('Integration Tests on Staging') {
            steps {
                 
                    echo 'Running integration tests on staging...'
                
            }
            post {
                success {
                    echo 'Integration tests on staging passed!'
                }
                failure {
                    echo 'Integration tests on staging failed!'
                }
            }
        }

        stage('Deploy to Production') {
            steps {
                
                    echo 'Deploying to production...'
                
            }
            post {
                success {
                    echo 'Deployed to production successfully!'
        
                }
                failure {
                    echo 'Deployment to production failed!'
                }
            }
        }
    }
}
