import {number, object, ref, string} from "yup";

const schema = object({
  first_name: string().required("First name is required"),
  last_name: string().required("Last name is required"),
  email: string().required("Email is required").email(),
  phone_number: number().typeError("Phone must be a number"),
  password: string().required().min(8),
  password_confirmation: string().oneOf([ref('password')], "Passwords do not match").required("Confirm your password")
})

export default schema