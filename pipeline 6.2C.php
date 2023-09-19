pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                
                    echo 'mvn clean install'
                }
            
            post {
                success {
                    echo 'Build completed successfully!'
                    mail to: "aleenaf281@gmail.com",
                    subject: "Build completed Email",
                    body: "Build completed completed"
                    

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
                    mail to: "aleenaf281@gmail.com",
                    subject: "Tests passed Email",
                    body: "Tests passed completed"
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
                    mail to: 'aleenaf281@gmail.com',
                    subject: 'Code Analysis completed',
                    body: 'The code analysis is completed.'
                    
                    
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
                    mail to: "aleenaf281@gmail.com",
                    subject: "Security Scan Email",
                    body: "Security Scan completed"
                    
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
                    mail to: "aleenaf281@gmail.com",
                    subject: "Deploy to Staging Email",
                    body: "Deploy to Staging completed"
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
                    mail to: "aleenaf281@gmail.com",
                    subject: "Integration Tests on Staging Email",
                    body: "Integration Tests on Staging completed"
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
                    mail to: "aleenaf281@gmail.com",
                    subject: "Deployed to production successfully Email",
                    body: "Deployement completed"
        
                }
                failure {
                    echo 'Deployment to production failed!'
                }
            }
        }
    }
}
