def grade(arg, key):
    if "flag{rickrolled}".lower() == key.lower():
        return True, "=)"
    else:
        return False, "..."
