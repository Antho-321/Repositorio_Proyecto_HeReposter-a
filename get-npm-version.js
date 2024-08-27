const { execSync } = require('child_process');

try {
  const npmVersion = execSync('npm --version', { encoding: 'utf-8' }).trim();
  console.log(`npm version: ${npmVersion}`);
} catch (error) {
  console.error('Error getting npm version:', error.message);
}