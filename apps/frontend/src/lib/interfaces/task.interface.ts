import { User } from "./user.interface";

export interface Task {
    id: string;
    key: string;
    summary: string;
    description: string;
    user: User;
}