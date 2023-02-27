import User from './model/User';
import Validator from './app.validator';
import Crypt from './methods/crypt';

interface user {
  name: string;
  email: string;
  password: string;
}

export default class UserController {
  async create(validator: Validator, body: user) {
    const { name, email, password } = body;

    const validateUserData = validator.validateUserData(name, email, password);

    if (validateUserData) return validateUserData;

    const validateIfEmailAlreadyExists =
      await validator.validateIfEmailAlreadyExists(email);

    if (validateIfEmailAlreadyExists) return validateIfEmailAlreadyExists;

    const hashPassword = Crypt.cryptPass(password);

    const user = await User.create({
      name,
      email,
      password: hashPassword,
    });

    return user;
  }

  async delete(id: string) {
    return User.findByIdAndRemove(id);
  }

  getUsers() {
    return User.find();
  }
}
