import { hashSync } from 'bcrypt';
const salt = '$2b$10$JMaxpcJIGx9MKxjUOISAZ.';

export default {
  cryptPass(pass: string): string {
    return hashSync(pass, salt);
  },
  comparePass(passInput: string, passCrypt: string): boolean {
    return hashSync(passInput, salt) === passCrypt;
  },
};
