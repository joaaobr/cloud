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

  async update(validator: Validator, body: user, id: string) {
    const validateId = await validator.validateIfIdAlreadyExists(id);

    if (validateId) return validateId;

    const user = await User.findByIdAndUpdate(id, body, { now: true });

    console.log(user)
      
    return user;
  }

  getUsers() {
    return User.find();
  }
}
