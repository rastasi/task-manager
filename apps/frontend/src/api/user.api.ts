import { User } from "@/lib/interfaces/user.interface";
import api from "@/api/api";

const index = async (): Promise<User[]> => {
    const response = await api.apiCall().get("/users");
    return response.data as User[];
}

export default {
    index,
}