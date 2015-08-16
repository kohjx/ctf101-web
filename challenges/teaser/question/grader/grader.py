def grade(arg, key):
    if "flag{g00gl3_!s_y0ur_b3st_fr!3nd}".lower() == key.lower():
        return True, "=)"
    else:
        return False, "..."
