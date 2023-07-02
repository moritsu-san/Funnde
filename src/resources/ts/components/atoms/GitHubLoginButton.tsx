import { FC } from "react";
import { Provider } from "../../models/OAuth";
import { Button } from "@mui/material";
import GitHubIcon from "@mui/icons-material/GitHub";

type Props = {
    handleSocialLoginRequest: (provider: Provider) => void;
};

const GitHubLoginButton: FC<Props> = ({ handleSocialLoginRequest }) => (
    <Button
        variant="contained"
        startIcon={<GitHubIcon />}
        fullWidth
        sx={{
            color: "#fff",
            backgroundColor: "#24292e",
            textTransform: "none",
        }}
        onClick={(e) => {
            e.preventDefault();
            handleSocialLoginRequest("github");
        }}
    >
        Login with GitHub
    </Button>
);

export default GitHubLoginButton;
