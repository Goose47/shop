import { object, ref, string} from "yup";

function checkPhoneLength(phoneNumber) {
  return phoneNumber.length <= 18
}

function checkPhoneCharacters(phoneNumber) {
  let number = phoneNumber.replace(/[\d*\s+\-()]/g, '')
  return number.length === 0
}

const schema = object({
  first_name: string().required("First name is required"),
  last_name: string().required("Last name is required"),
  email: string().required("Email is required").email(),
  phone_number: string().required("Phone number is required.")
    .test('test-phone-characters', 'Phone number must contain only digits and special characters ("(", ")", "+").', checkPhoneCharacters)
    .test('test-phone-length', 'Phone number must have no more than 11 digits.', checkPhoneLength),
  password: string().required().min(8),
  password_confirmation: string().oneOf([ref('password')], "Passwords do not match").required("Confirm your password")
})

export default schema