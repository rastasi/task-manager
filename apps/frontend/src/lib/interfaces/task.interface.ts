import { User } from "./user.interface";

export interface Task {
    description: string;
    userId: number;
    user?: User;
    estimatedTime: number;
    usedTime: number;
    id: number;
    completedAt: string;
    selected: boolean;
}